//Select all icons with the icon class
document.querySelectorAll(".icon").forEach((icon) => {
  //Set eventlistener on each icon
  icon.addEventListener("click", function () {
    //"this" is the reference of the clicked icon (Eventlistener)
    const moodLevel = this.getAttribute("data-value"); //data-value is the Number-Value of the selected icon
    //In which section (mood or energy) is the icon located
    const section = this.parentElement;
    let inputId; //Id of the hidden Field to transfer the clicked icon Id to the backend
    if (section.id === "feeling") {
      inputId = "feeling-input";
    } else {
      inputId = "energy-input";
    }

    //Set the value(1,2,3..) of the clicked icon into the correct hidden field
    document.getElementById(inputId).value = moodLevel;

    // Remove selected class from all emojis
    this.parentElement.querySelectorAll(".icon").forEach((e) => e.classList.remove("selected"));

    // Add selected class to the clicked emoji
    this.classList.add("selected");
  });
});

//Form submission validation
document.querySelector("form").addEventListener("submit", function (event) {
  const feelingValue = document.getElementById("feeling-input").value;
  const energyValue = document.getElementById("energy-input").value;

  //Check if both values are set
  if (!feelingValue || !energyValue) {
    event.preventDefault(); //Prevent form submission
    alert("Bitte geben Sie Werte für Stimmung und Energie Level ein."); //Alert the user
  }
});
