document.addEventListener('DOMContentLoaded',() => {
    const modal =
document.getElementById('termsModal');
const acceptButton = document.getElementById('acceptTerms');

if(!localStorage.getItem('termsAccepted')){
    modal.style.display = 'block' ;
}

acceptButton.addEventListener('click',() => {
    localStorage.setItem('termsAccepted', 'true');
    modal.style.display = 'none';
});
});