const afficherIngredient = document.getElementById("afficherIngredient");
const masquerIngredient = document.getElementById("masquerIngredient");
const selectIngredient = document.getElementById("ingredient");


selectIngredient.style.display = "none";
masquerIngredient.style.display = "none";

afficherIngredient.addEventListener('click', () => {
    selectIngredient.style.display = "block";
    afficherIngredient.style.display = "none";
    masquerIngredient.style.display = "block";
});

masquerIngredient.addEventListener('click', () => {
    selectIngredient.style.display = "none";
    masquerIngredient.style.display = "none";
    afficherIngredient.style.display = "block";
});


////////////////////////////////////////////////////:

const buttonAjouter = document.getElementById("buttonAjouter");
const sectionAjouter = document.getElementById("sectionAjouter");

/**
 * @param {string} idOuNom 
 * @param {boolean} estConnu 
 * @param {string} idCheckbox 
 */
const ajouterIngredientAuDOM = (idOuNom, estConnu, idCheckbox = null) => {
    const div = document.createElement("div");
    div.style.marginBottom = "15px";
    div.style.padding = "10px";
    div.style.borderBottom = "1px solid #ccc";
    div.style.position = "relative";

  
    if (idCheckbox) {
        div.id = "bloc-" + idCheckbox;
    }

    
    
    let ligneNom = "";
    if (estConnu) {
        ligneNom = `
            <p><strong>${idOuNom}</strong> :</p>
            <input type="hidden" name="ingredients_existants_ids[]" value="${idCheckbox}">
        `;
    } else {
        ligneNom = `
            <button type="button" style="color:red; margin-left:10px;" onclick="this.parentElement.parentElement.remove()">X</button>

            <label>Nom de l'ingrédient : </label>
            <input type="text" name="nouveaux_ingredients_noms[]" placeholder="Ex: Farine" required>
        `;
    }

    div.innerHTML = `
        <div class="nom-container">
            ${ligneNom}
        </div>
        <div style="margin-top: 8px;">
            <label>Quantité (Préciser l'unités ex: cl, g) :</label>
            <input type="number" name="ingredients_quantites[]" step="any"">
            
        </div>
    `;

    sectionAjouter.appendChild(div);
};


document.querySelectorAll("input[type='checkbox']").forEach(checkbox => {
    checkbox.addEventListener("change", (e) => {
        
        const idIng = e.target.name; 
        const nomIng = e.target.id;   
        
        if (e.target.checked) {
            ajouterIngredientAuDOM(nomIng, true, idIng);
        } else {
            const blocASupprimer = document.getElementById("bloc-" + idIng);
            if (blocASupprimer) {
                blocASupprimer.remove();
            }
        }
    });
});


buttonAjouter.addEventListener("click", () => {
    ajouterIngredientAuDOM("", false);
});




////////////////////////////////////////////////


const prevBtn = document.getElementById("prevBtn");
const nextBtn = document.getElementById("nextBtn");
const submitBtn = document.querySelector('input[value="Envoyer ma recette"]');
const stepNumbers = document.querySelectorAll(".step-number");
const stepProgression = document.querySelector("#stepProgression");

let currentStep = 1;


updateDisplay();


stepNumbers.forEach((step, i) => {
    step.onclick = () => {
        currentStep = i + 1;
        updateDisplay();
    };
});

prevBtn.onclick = () => {
    if (currentStep > 1) {
        currentStep--;
        updateDisplay();
    }
};

nextBtn.onclick = () => {
    if (currentStep < stepNumbers.length) {
        currentStep++;
        updateDisplay();
    }
};


function updateDisplay() {
    // 1. Gérer les bornes
    if (currentStep < 1) currentStep = 1;
    if (currentStep > stepNumbers.length) currentStep = stepNumbers.length;

   
    stepNumbers.forEach((step, i) => {
        if (i < currentStep) {
            step.classList.add("active");
        } else {
            step.classList.remove("active");
        }
    });

    if (stepProgression) {
        stepProgression.style.width = ((currentStep - 1) / (stepNumbers.length - 1)) * 100 + "%";
    }

 
    document.querySelectorAll('fieldset[id^="etape"]').forEach((fieldset, index) => {
        fieldset.style.display = (index + 1 === currentStep) ? "block" : "none";
    });

    
    prevBtn.style.display = (currentStep === 1) ? "none" : "inline";

   
    if (currentStep === stepNumbers.length) {
        nextBtn.style.display = "none";
        submitBtn.style.display = "inline";
    } else {
        nextBtn.style.display = "inline";
        submitBtn.style.display = "none";
    }
}

