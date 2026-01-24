const prevBtn = document.getElementById("prevBtn");
const nexBtn = document.getElementById("nextBtn");
const stepNumbers = document.querySelectorAll (".step-number");
const stepProgression = document.querySelector("#stepProgression");


let currentStep = 1;
update();
afficherEtape();
afficherBoutton();

stepNumbers.forEach((step, i)=> {
    step.onclick = () => {
        currentStep = i + 1;
        update();
        afficherEtape();
        afficherBoutton();
        
    }

});

prevBtn.onclick = () => {
    currentStep-- ;
    update();
    afficherEtape();
    afficherBoutton();
}

nexBtn.onclick = () => {
    currentStep++ ;
    update();
    afficherEtape();
    afficherBoutton();
}

function update(){

    if (currentStep <= 1) {
        currentStep = 1;

        
    }
    else if (currentStep >= stepNumbers.length) {
        currentStep = stepNumbers.length;
        
    }

    stepNumbers.forEach((step, i) => {
        if(currentStep > i) {
            step.classList.add("active");
        } else{
            step.classList.remove("active");
        }
        

        stepProgression.style.width = ((currentStep - 1) / (stepNumbers.length - 1)) * 100 + "%";
    })




}

function afficherEtape(){

   
    document.querySelectorAll('[id^="etape"]').forEach(el => {
        el.style.display = "none";
    });

   
    document.querySelector(".etape4-1").style.display = "none";
    document.querySelector(".etape4-2").style.display = "none";

   
    if (currentStep <= 4) {
        document.getElementById(`etape${currentStep}`).style.display = "block";
    } else {
        document.getElementById("etape4").style.display = "block";
    }

   
    if (currentStep === 4) {
        document.querySelector(".etape4-1").style.display = "block";
    }

    if (currentStep === 5) {
        document.querySelector(".etape4-2").style.display = "block";
        
    }
}


function afficherBoutton(){

    if (currentStep < 5) {

        document.querySelector('input[value="Valider"]').style.display = "none";
        document.querySelector('input[value="Continuer"]').style.display = "inline";
    }

    if (currentStep === 5) {

        document.querySelector('input[value="Valider"]').style.display = "inline";
        document.querySelector('input[value="Continuer"]').style.display = "none";
    }
}