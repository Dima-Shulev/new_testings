buttonQuestion.addEventListener('click', (event) => {
    if(checkFlag === "arr"){
        trueAnswers = JSON.parse(trueAnswers)
        let arrAll = []
        let av = document.getElementsByName("checkbox[]");
        for (e = 0; e < av.length; e++) {
            if (av[e].checked === true) {
                arrAll.push(av[e].value);
            }
        }
        if(Number(showAnswers) === 1) {
            if (arrAll.sort().join(',') === trueAnswers.sort().join(',')) {
                answers.style.display = 'block'
                answers.style.background = '#badcba'
                trueAnsDiv.style.display = 'block'
            } else {
                answers.style.display = 'block'
                answers.style.background = '#fad1d1'
                falseAnsDiv.style.display = 'block'
            }
        }
        setTimeout(() => {
            nextQuestion.click()
        }, 5000)
    }else if(checkFlag === "str") {
        const checkRadio = document.querySelector('input[type=radio]:checked');
        const res = MD5(String(checkRadio.id));

        if(Number(showAnswers) === 1){
            if (String(res) === String(trueAnswers)) {
                answers.style.display = 'block'
                answers.style.background = '#badcba'
                trueAnsDiv.style.display = 'block'
            } else {
                answers.style.display = 'block'
                answers.style.background = '#fad1d1'
                falseAnsDiv.style.display = 'block'
            }
        }
        setTimeout(() => {
            nextQuestion.click()
        }, 5000)
    }
});
