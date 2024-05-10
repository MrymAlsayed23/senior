const nexBut = document.querySelector('.btn-nex');
const subBut = document.querySelector('.btn-sub');
const steps = document.querySelectorAll('.step');
const form_steps = document.querySelectorAll('.form-step');
document.getElementById("myForm").reset();

let active = 0;
nexBut.addEventListener('click', ()=>{
    active++;
    if (active > steps.length){
        active = steps.length;
    }
    updateProgress();

});
nexBut.addEventListener('click', ()=>{
    
    if (active < (steps.length-1)){
        active ++;
    }
    updateProgress();
});

const updateProgress = ()=>{
    console.log('steps-length =>' +steps.length);
    console.log('active =>' +active);
    steps.forEach((step, i) => {
        if (i == (active-1)){
            step.classList.add('active');
            form_steps[i].classList.add('active');
            console.log('i=>'+i);
        }
        else {
            step.classList.remove('active');
            form_steps[i].classList.remove('active');
        }

    });
    if (active == 1 ){
        subBut.disabled = true;
    }
    else if(active == steps.length){
        nexBut.disabled = true;
        subBut.disabled = false;
        
    }

    
}
