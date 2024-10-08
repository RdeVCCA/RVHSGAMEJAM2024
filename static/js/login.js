const popup = document.querySelector('.login');
const background = document.querySelector('.popup-background');

function togglePopup(state) {
    if (state === 'open') {
        popup.classList.add('active');
        background.classList.add('active');
    }
    else if (state === 'close') {
        popup.classList.remove('active');
        background.classList.remove('active');
    }
    else {
        popup.classList.toggle('active');
        background.classList.toggle('active');
    }
}

background.addEventListener('click', () => {
    togglePopup('close');
});