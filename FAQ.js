document.querySelectorAll('.faq-Question').forEach(item => {
    item.addEventListener('click',() => {
        const answer =item.nextElementSibling;
        const arrow=item.querySelector('.arrow');
        if(answer.style.display ==='block'){answer.style.display ='none';
            arrow.classList.remove('arrow-down');
        }else{
            answer.style.display='block';
            arrow.classList.add('arrow-down');
        }
    });
});