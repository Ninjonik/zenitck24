/* SEND PACKAGE */

    /* CENA VYPOCET */
    let cenaVelkost = 0;

    let cenaStat = 0;

    const priceText = document.getElementById("price");
    const handlePriceUpdate = () => {
        priceText.value = cenaVelkost + cenaStat;
    }

    /* OBVOD CALCULATION + VEĽKOSTNÁ KATEGÓRIA */
    const width = document.getElementById("width");
    const height = document.getElementById("height");
    const length = document.getElementById("length");

    const obvod = document.getElementById("obvod");

    const size = document.getElementById("size");
    const prirazka = document.getElementById("prirazka");

   

    const handleObvodChange = () => {
        if (width.value && height.value && length.value){
            if(length.value > 75) {
                size.innerHTML = "NEPLATNÁ DĹŽKA, MAX 75cm";
                prirazka.innerHTML = 0; 
                return;
            }

            const newObvod = (2*width.value + 2*height.value + length.value);
            let sizeVal = "";
            let prirazkaVal = 0;
            obvod.innerHTML = newObvod.toString() + " cm"
            if (newObvod < 70){
                sizeVal = "XS";
                prirazkaVal = 5;
            } else if (newObvod < 95){
                sizeVal = "S";
                prirazkaVal = 9;
            } else if (newObvod < 130){
                sizeVal = "M";
                prirazkaVal = 21;
            } else if (newObvod < 150){
                sizeVal = "L";
                prirazkaVal = 15;
            } else if (newObvod < 250){
                sizeVal = "XL";
                prirazkaVal = 18;
            } else {
                sizeVal = "XXL";
                prirazkaVal = 30;
            }
            size.innerHTML = sizeVal;
            prirazka.innerHTML = prirazkaVal;
            cenaVelkost = prirazkaVal;
            handlePriceUpdate()
        }
    }

    width.addEventListener("change", handleObvodChange);
    height.addEventListener("change", handleObvodChange);
    length.addEventListener("change", handleObvodChange);
    

    /* COUNTRY PRIRAZKA HANDLER */
    const countrySelect = document.getElementById("country");

    countrySelect.addEventListener("change", () => {
        const countryValue = countrySelect.value;
        if(!countryValue) return;

        let prirazkaCountry = 0;

        switch (countryValue.toUpperCase()){
            case "SK":
                prirazkaCountry = 0;
                break;
            case "CZ":
            case "AT":
            case "HU":
            case "PL":
                prirazkaCountry = 5;
                break;
            case "DE": 
            case "HR": 
            case "BG":
                prirazkaCountry = 20;
                break;
        }

        cenaStat = prirazkaCountry;
        console.log(cenaStat)
        handlePriceUpdate()
    })