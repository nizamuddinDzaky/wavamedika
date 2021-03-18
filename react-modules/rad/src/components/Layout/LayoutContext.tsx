import React, {
    createContext,
    useContext,
    useEffect,
    useMemo,
    useReducer
} from "react";

/**
 * Both context used to create inside react `redux`-like global state managed
 * entirely by react.
 *
 * @see https://kentcdodds.com/blog/how-to-use-react-context-effectively
 */

const LayoutContext = {
    /**
     * Stores layout state, can be consumed globally.
     */
    State: createContext(null),

    /**
     * Stores `dispatch` function to update layout state, intended to be internal.
     */
    Dispatch: createContext(null)
};

/**
 * Layout action types, used to filter out dispatched actions.
 */
const actionTypes = {
    /**
     * Initializes layout state from provided `{ pathname, menuConfig }` action
     * payload.
     */
    INIT: "INIT",

    /**
     * Updates current subheader from provided `{ title }` action payload.
     */
    SET_SUBHEADER: "SET_SUBHEADER",

    /**
     * Controls splash screen visibility.
     */
    SHOW_SPLASH_SCREEN: "SHOW_SPLASH_SCREEN",
    HIDE_SPLASH_SCREEN: "HIDE_SPLASH_SCREEN"
};

/**
 * Recursively runs over `items` to find `pageConfig` of `currentPage`.
 *
 * Returns `undefined` if there are no matches.
 */
function findPageConfig(currentPage: any, items: Array<any>, breadcrumbs: any) {
    // Ignore non array `items`.
    if (!items || !Array.isArray(items)) {
        return null;
    }

    for (const item of items) {
        // Return `item` if it's `page` matches `currentPage`
        if (currentPage.includes(item.page) && !item.submenu) {
            return item;
        }

        // Try to `pageConfig` in `item.submenu` if it is defined.
        if (item.submenu) {
            const pageConfig:any = findPageConfig(currentPage, item.submenu, breadcrumbs);
            if (pageConfig) {
                breadcrumbs.push(item);
                return pageConfig;
            }
        }
    }
}

/**
 * Used to lazily create initial layout state.
 */
function init({ pathname, menuConfig }: any) {
    const currentPage = pathname.slice(1 /* Remove leading slash. */);
    let breadcrumbs: any = [];
    const pageConfig: any =
        findPageConfig(currentPage, menuConfig.aside.items, breadcrumbs) ||
        findPageConfig(currentPage, menuConfig.header.items, breadcrumbs);

    breadcrumbs.reverse();
    const state = { subheader: { title: "", breadcrumb: [], description: "" }, splashScreen: { refs: {} } };
    if (pageConfig) {
        breadcrumbs.push(pageConfig);
        state.subheader.title = pageConfig.title;
        state.subheader.breadcrumb = breadcrumbs;
    }

    return state;
}

function reducer(state: any, { type, payload }: any) {
    if (type === actionTypes.INIT) {
        const nextState = init(payload);

        // Update only subheader.
        return { ...state, subheader: nextState.subheader };
    }

    if (type === actionTypes.SET_SUBHEADER) {
        return { ...state, subheader: payload };
    }

    if (type === actionTypes.SHOW_SPLASH_SCREEN) {
        return {
            ...state,
            splashScreen: {
                ...state.splashScreen,
                refs: { ...state.splashScreen.refs, [payload.id]: true }
            }
        };
    }

    if (type === actionTypes.HIDE_SPLASH_SCREEN) {
        const { [payload.id]: skip, ...nextRefs } = state.splashScreen.refs;

        return {
            ...state,
            splashScreen: { ...state.splashScreen, refs: nextRefs }
        };
    }

    return state;
}

/**
 * Creates layout reducer and provides it's `state` and ` dispatch`.
 */
export function LayoutContextProvider({ history, children, menuConfig }: any) {
    const [state, dispatch]: any = useReducer(
        reducer,
        { menuConfig, pathname: history.location.pathname },
        // See https://reactjs.org/docs/hooks-reference.html#lazy-initialization
        init
    );

    // Subscribe to history changes and reinitialize on each change.
    useEffect(
        () =>
            history.listen(({ pathname }: any) => {
                dispatch({
                    type: actionTypes.INIT,
                    payload: { pathname, menuConfig }
                });
            }),

        /**
         * Passing `history` and `menuConfig` to `deps` ensures that `useEffect`
         * will cleanup current `history` listener and will dispatch `INIT`
         * with `menuConfig` reference from current render.
         *
         * @see https://reactjs.org/docs/hooks-reference.html#conditionally-firing-an-effect
         */
        [history, menuConfig]
    );

    const { refs: splashScreenRefs } = state.splashScreen;
    const splashScreenVisible = useMemo(
        () => Object.keys(splashScreenRefs).length > 0,
        [splashScreenRefs]
    );

    useEffect(() => {
        const splashScreen: any = document.getElementById("splash-screen");
        // const menu: any = document.getElementById('root');
        const menu: any = document.getElementsByTagName('body');
        menu[0].scrollTo(0,0);

        if (splashScreenVisible) {
            splashScreen.classList.remove("hidden");
            // menu[0].classList.add('overflow-scroll');


            return () => {
                splashScreen.classList.add("hidden");
                // menu[0].classList.add('overflow-scroll');

            };
        }

        const timeout = setTimeout(async () => {
            splashScreen.classList.add("hidden");
            menu[0].classList.add('overflow-scroll');
        }, 1000);

        return () => {
            clearTimeout(timeout);
        };
    }, [splashScreenVisible]);

    // Pass state and dispatch to it's contexts.
    return (
        <LayoutContext.State.Provider value={state}>
            <LayoutContext.Dispatch.Provider value={dispatch}>
                {children}
            </LayoutContext.Dispatch.Provider>
        </LayoutContext.State.Provider>
    );
}

/**
 * Used to access latest layout context state.
 *
 * @example
 *
 * export function Subheader() {
 *   return (
 *     <LayoutContextConsumer>
 *       {({ subheader: { title } }) => <h1>{title}</h1>}
 *     </LayoutContextConsumer>
 *   );
 * }
 */
export const LayoutContextConsumer = LayoutContext.State.Consumer;

/**
 * Hook to access latest layout context state.
 *
 * @example
 *
 * export function Subheader() {
 *   const { subheader: { title } } = useLayoutContext();
 *
 *   return <h1>{title}</h1>;
 * }
 */
export function useLayoutContext() {
    const context = useContext(LayoutContext.State);

    if (!context) {
        throw new Error("");
    }

    return context;
}

/**
 * Used to override layout subheader state.
 */
export function LayoutSubheader({ title, breadcrumb, description }: any) {
    const dispatch: any = useContext(LayoutContext.Dispatch);

    useEffect(() => {
        dispatch({
            type: actionTypes.SET_SUBHEADER,
            payload: { title, breadcrumb, description }
        });
    }, [dispatch, title, breadcrumb, description]);

    return null;
}

export function LayoutSplashScreen({ visible = false }) {
    const dispatch: any = useContext(LayoutContext.Dispatch);

    useEffect(() => {
        if (!visible) {
            return;
        }

        const id = Math.random();

        dispatch({ type: actionTypes.SHOW_SPLASH_SCREEN, payload: { id } });

        return () => {
            dispatch({ type: actionTypes.HIDE_SPLASH_SCREEN, payload: { id } });
        };
    }, [visible, dispatch]);

    return null;
}
