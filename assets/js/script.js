"use strict";

console.log("Loaded the script.js!");

const SPINNING_LOADER = document.querySelector("#spinningLoader");

if (SPINNING_LOADER)
{
    SPINNING_LOADER.style.display = "none"; // TODO: Remove later!

    /*
    setTimeout(function () {
        SPINNING_LOADER.style.display = "none";
    }, 500);
    */
}
