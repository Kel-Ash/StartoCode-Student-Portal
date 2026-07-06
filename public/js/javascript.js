document.addEventListener('DOMContentLoaded', function(){
const studentform = document.getElementById('student-user-form');
    if(studentform){
        studentform.addEventListener('submit', (e) =>{
        if(!handleFormValidation(this)){
                e.preventDefault();
            handleFormValidation();
        };
        });
    }

// Function to handle form validation
function handleFormValidation(){
    const firstname = document.getElementById('user-firstname').value.trim();
    const middlename = document.getElementById('user-middlename').value.trim();
    const lastname = document.getElementById('user-lastname').value.trim();
    const email = document.getElementById('user-email').value.trim();
    const  dob = document.getElementById('user-date-of-birth').value.trim();
    const maleGender = document.getElementById('user-gender-male').checked;
    const femaleGender = document.getElementById('user-gender-female').checked;
    const genderSelected = maleGender || femaleGender;
    const contact = document.getElementById('user-phone').value.trim();
    const address = document.getElementById('user-address').value.trim();
    const stateofOrigin = document.getElementById('user-state-of-origin').value.trim();
    const localGovernment = document.getElementById('user-local-government').value.trim();
    const nextOfKing = document.getElementById('user-next-of-kin').value.trim();
    const jampScore = document.getElementById('user-jamb-score').value.trim();
    const ErrorBox = document.getElementById('error')


if(!firstname || !lastname || !email || !dob || !genderSelected || !contact || !address || stateofOrigin === "Select-State" || localGovernment === "Select-Local-Government" || !nextOfKing || !jampScore){
    ErrorBox.textContent = "Please fill in all required information";
    ErrorBox.classList.add("active");
    return false;
}else if(!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)){
    ErrorBox.textContent = "Please Enter a valid Email";
    ErrorBox.classList.add("active");
    return false;
}else if(contact.length !== 10){
    ErrorBox.textContent = "Contact Should be of 10 Digit ! Please Enter a Valid Number.";
    ErrorBox.classList.add("active");
    return false;
}else if(!/^\d+$/.test(contact)){
    ErrorBox.textContent = "Contact Should contain only digit";
    ErrorBox.classList.add("active");
    return false;
}else if(!/^\d+$/.test(jampScore)){
    ErrorBox.textContent = "Jamb Score Should contain only digit";
    ErrorBox.classList.add("active");
    return false;
}
else{
    ErrorBox.textContent = "";
    ErrorBox.classList.remove("active");

    return true;
}

}


// get data from 
const stateSelect = document.getElementById('user-state-of-origin');
const localGovernmentSelect = document.getElementById('user-local-government');

if(stateSelect && localGovernmentSelect){
    countryData.states.forEach(item => {
    const option = document.createElement('option');
    option.value = item.state;
    option.textContent = item.state;
    stateSelect.appendChild(option);
});
}

//listen for state selection change
stateSelect.addEventListener('change', function(){
    const selectedState = this.value;
    localGovernmentSelect.innerHTML = `<option value="">Select-Local-Government</option>`; 

    if(selectedState !== ""){
        const matchedState = countryData.states.find(item =>item.state === selectedState);
        if(matchedState && matchedState.local){
            matchedState.local.forEach(localGovernment => {
                const option = document.createElement('option');
                option.value = localGovernment;
                option.textContent = localGovernment;
                localGovernmentSelect.appendChild(option);
            });
        }
    }

});

// checking image file type
const imageInput = document.getElementById('user-image');
const ErrorBox = document.getElementById('error')

imageInput.addEventListener('change', function(){
    const file = this.files[0];
    if(file){

        if(!file.type.startsWith('image/')){
            ErrorBox.textContent = 'Please select a valid image file (jpg, jpeg, png)';
            ErrorBox.classList.add("active");
            this.value = ''; // Clear the input
        } 
    }else{
    
    }
    });

    
const popup = document.getElementById('success-popup');
    
    if (popup) {
        // delay before sliding down so the user notices the movement
        setTimeout(() => {
            popup.classList.add('show');
        }, 100);

        // Automatically slide up and hide after 4 seconds
        setTimeout(() => {
            popup.classList.remove('show');
            
            // Remove the popup from the DOM after the slide-up transition
            setTimeout(() => {
                popup.remove();
            }, 500); // 500ms for the slide-up transition
            
        }, 4000);
    }

});

