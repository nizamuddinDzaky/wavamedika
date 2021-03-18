// This optional code is used to register a service worker.
// register() is not called by default.

// This lets the app load faster on subsequent visits in production, and gives
// it offline capabilities. However, it also means that developers (and users)
// will only see deployed updates on subsequent visits to a page, after all the
// existing tabs open on the page have been closed, since previously cached
// resources are updated in the background.

// To learn more about the benefits of this model and instructions on how to
// opt-in, read https://bit.ly/CRA-PWA
import Swal from 'sweetalert2';

// importScripts("https://storage.googleapis.com/workbox-cdn/releases/4.3.1/workbox-sw.js");


function notifyUser(installingWorker?: any) {
    let timeInterval: any;
    Swal.fire({
        title: 'Pembaruan Aplikasi Terdeteksi',
        html: 'Terdapat pembaruan pada aplikasi tampilan, Halaman baru akan dimuat dalam <b></b> detik.',
        timer: 10000,
        timerProgressBar: true,
        showConfirmButton: false,
        allowOutsideClick: false,
        onBeforeOpen: () => {
            Swal.disableButtons();

            timeInterval = setInterval(() => {
                const content = Swal.getContent();
                if(content) {
                  const time = content.querySelector('b');
                  if(time) {
                    let timerTick: number = 0;
                    if(Swal && Swal.getTimerLeft) {
                      timerTick = Number(Swal.getTimerLeft());
                    }

                    const countInteger: number = parseInt((timerTick/1000).toString());
                    time.textContent = countInteger.toString();
                  }
                }
            }, 1000);
        },
        onClose: () => {
            clearInterval(timeInterval)
        }
    }).then(async (result) => {
        if (result.dismiss === Swal.DismissReason.timer) {
            await installingWorker.postMessage('skipWaiting');
            await installingWorker.postMessage('SKIP_WAITING');
            await installingWorker.postMessage({type: 'SKIP_WAITING'});
            window.location.reload();
        }
    })
}

// metronic remove config on update found.
//tes
function removeLocalStorage() {
  // localStorage.removeItem('persist:build-demo4');
    window.localStorage.removeItem('persist:build-demo4');
    window.localStorage.removeItem('build-demo4');

    if(process.env.REACT_APP_DEPLOY_MODE === 'full') {
        // reset client application settings
        window.localStorage.removeItem('persist:application-settings');
    }
}

const isLocalhost = Boolean(
  window.location.hostname === 'localhost' ||
    // [::1] is the IPv6 localhost address.
    window.location.hostname === '[::1]' ||
    // 127.0.0.0/8 are considered localhost for IPv4.
    window.location.hostname.match(
      /^127(?:\.(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)){3}$/
    )
);

type Config = {
  onSuccess?: (registration: ServiceWorkerRegistration) => void;
  onUpdate?: (registration: ServiceWorkerRegistration) => void;
};

export function register(config?: Config) {
  if (process.env.NODE_ENV === 'production' && 'serviceWorker' in navigator) {
  const getBasename = (path: string) => path.substr(0, path.lastIndexOf(process.env.PUBLIC_URL));

      // The URL constructor is available in all browsers that support SW.
    const publicUrl = new URL(
        process.env.PUBLIC_URL,
      window.location.href
    );
    if (publicUrl.origin !== window.location.origin) {
      // Our service worker won't work if PUBLIC_URL is on a different origin
      // from what our page is served on. This might happen if a CDN is used to
      // serve assets; see https://github.com/facebook/create-react-app/issues/2374
      return;
    }

    const base = getBasename(window.location.pathname);
    console.log('base', base);

    window.addEventListener('load', () => {
      let swUrl;

      if(base) {
          swUrl = base + `${process.env.PUBLIC_URL}/service-worker.js`;
      } else {
          swUrl = `${process.env.PUBLIC_URL}/service-worker.js`;
      }

      if (isLocalhost) {
        // This is running on localhost. Let's check if a service worker still exists or not.
        checkValidServiceWorker(swUrl, config);

        // Add some additional logging to localhost, pointing developers to the
        // service worker/PWA documentation.
        navigator.serviceWorker.ready.then(() => {
          console.log(
            'This web app is being served cache-first by a service ' +
              'worker. To learn more, visit https://bit.ly/CRA-PWA'
          );
        });
      } else {
        // Is not localhost. Just register service worker
        registerValidSW(swUrl, config);
      }
    });
  }
}

// window.self.addEventListener('message', (event) => {
//     console.log('new Event', event);
// });


function registerValidSW(swUrl: string, config?: Config) {
  console.log('prepare for sw registration');
    navigator.serviceWorker
    .register(swUrl)
    .then(registration => {
      console.log('sw update found');
      // const waiting = registration;
      // console.log('upd found', registration);

      registration.onupdatefound = () => {
          // console.log('installing', registration);

          // const waitingWorker =
          console.log('prepare for installing new version ...');
          const installingWorker = registration.installing;
        if (installingWorker == null) {
          return;
        }
        installingWorker.onstatechange = () => {
          if (installingWorker.state === 'installed') {
            console.log('new version installed');
            if (navigator.serviceWorker.controller) {
              // At this point, the updated precached content has been fetched,
              // but the previous service worker will still serve the older
              // content until all client tabs are closed.
              console.log(
                'New content is available and will be used when all ' +
                  'tabs for this page are closed. See https://bit.ly/CRA-PWA.'
              );


              removeLocalStorage();
              notifyUser(installingWorker);


                // show notification
              // const notification = document.getElementById("new-content-info");
              // if (notification) {
              //   notification.classList.remove("hidden");
              // }

              // Execute callback
              if (config && config.onUpdate) {
                console.log('done');
                config.onUpdate(registration);
              }
            } else {
              console.log('not installing any new version');
              // At this point, everything has been precached.
              // It's the perfect time to display a
              // "Content is cached for offline use." message.
              console.log('Content is cached for offline use.');

              // Execute callback
              if (config && config.onSuccess) {
                config.onSuccess(registration);
              }
            }
          }
          // else if(installingWorker.state === 'waiting') {
          //
          // }
          else {
            console.log('we are on state of activating');
            try {
                installingWorker.postMessage('skipWaiting');
                installingWorker.postMessage('SKIP_WAITING');
                installingWorker.postMessage({type: 'SKIP_WAITING'});
            } catch (e) {
                console.log('error', e)
            }
          }
        };
      };
    })
    .catch(error => {
      console.error('Error during service worker registration:', error);
    });
}

function checkValidServiceWorker(swUrl: string, config?: Config) {
  // Check if the service worker can be found. If it can't reload the page.
  fetch(swUrl, {
    headers: { 'Service-Worker': 'script' }
  })
    .then(response => {
      // Ensure service worker exists, and that we really are getting a JS file.
      const contentType = response.headers.get('content-type');
      if (
        response.status === 404 ||
        (contentType != null && contentType.indexOf('javascript') === -1)
      ) {
        // No service worker found. Probably a different app. Reload the page.
        navigator.serviceWorker.ready.then(registration => {
          registration.unregister().then(() => {
            window.location.reload();
          });
        });
      } else {
        // Service worker found. Proceed as normal.
        console.log('found service worker');
        registerValidSW(swUrl, config);
      }
    })
    .catch(() => {
      console.log(
        'No internet connection found. App is running in offline mode.'
      );
    });
}

export function unregister() {
  if ('serviceWorker' in navigator) {
    navigator.serviceWorker.ready.then(registration => {
      registration.unregister();
    });
  }
}
