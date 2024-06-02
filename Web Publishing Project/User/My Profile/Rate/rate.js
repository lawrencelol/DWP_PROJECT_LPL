$("#back_btn").click(function (){
    window.history.back();
})

const allStar = document.querySelectorAll('.rating .star');

allStar.forEach((item, idx) => {
    item.addEventListener('click', function () {
        allStar.forEach(i=> {
            i.classList.replace('bxs-star', 'bx-star');
            i.classList.remove('active')
        })
        for(let i = 0; i < allStar.length; i++) {
            if(i <= idx) {
                allStar[i].classList.replace('bx-star', 'bxs-star');
                allStar[i].classList.add('active');
            } else {
                allStar[i].computedStyleMap.setProperty('--i', click)
                click++
            }
        }
    });
});

form.addEventListener('submit', (event) => {
    event.preventDefault();
    localStorage.setItem('rating', ratingInput.value);
    localStorage.setItem('username', usernameInput.value);
    localStorage.setItem('comment', commentInput.value);
    
    alert('Form data has been successfully saved!');
});

document.querySelector('.cancel').addEventListener('click', () => {
    form.reset();
    allStar.forEach(star => star.classList.replace('bxs-star', 'bx-star'));
});

    const savedRating = localStorage.getItem('rating');
    const savedUsername = localStorage.getItem('username');
    const savedComment = localStorage.getItem('comment');

    if (savedRating) {
        ratingInput.value = savedRating;
        for (let i = 0; i < savedRating; i++) {
            allStar[i].classList.replace('bx-star', 'bxs-star');
        }
    }

    if (savedUsername) {
        usernameInput.value = savedUsername;
    }

    if (savedComment) {
        commentInput.value = savedComment;
    }
