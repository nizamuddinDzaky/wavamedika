import swal from 'sweetalert2';

const NotifyError = (title?: string, message?: string) => {
    swal.fire({
        icon: 'error',
        title: title,
        text: message
    })
};

const NotifySuccess = (title?: string, message?: string) => {
    swal.fire({
        icon: 'success',
        title: title,
        text: message
    })
};

export {
    NotifyError,
    NotifySuccess
}
