(()=>{
	
    const form = document.querySelector("#contactForm");
    const feedBack = document.querySelector("#feedback");

    function regForm(event) {
        event.preventDefault();
        // console.log("form has been called");

        const thisform = event.currentTarget;
        const url = "adduser.php"

        const formData = new URLSearchParams({
            lname: thisform.elements.lname.value,
            fname: thisform.elements.fname.value,
            email: thisform.elements.email.value,
            message: thisform.elements.message.value
            });

            // console.log(formData);

            fetch(url, {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: formData
            })
            .then(response => response.json())
            .then(responseText => {
                console.log(responseText);

                feedBack.innerHTML = "";

                if(responseText.errors){
                    responseText.errors.forEach(error =>{
                        const errorElement = document.createElement("p");
                        errorElement.textContent = error;
                        feedBack.appendChild(errorElement);
                    })
                } else {
                    form.reset();
                    const messageElement = document.createElement("p");
                    messageElement.textContent = responseText.message;
                    feedBack.appendChild(messageElement);
                }
                feedBack.scrollIntoView({behavior: 'smooth', block: 'end'})
            })
            .catch(error => {
                console.error("Error during fetch:", error);
                feedBack.innerHTML = "";
                const errorMessageElement = document.createElement("p");
                errorMessageElement.textContent = "That didn’t work as planned. Please try again later.";
                feedBack.appendChild(errorMessageElement);
            })
    }

    form.addEventListener("submit", regForm);

})();