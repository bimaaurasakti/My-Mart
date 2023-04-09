const toastLiveExample = document.getElementById('liveToast')
const toast = new bootstrap.Toast(toastLiveExample)
toast.show()

const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
