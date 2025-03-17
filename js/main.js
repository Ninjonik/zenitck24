/* HEADER */

const content = document.getElementById("content");
const collapseButton = document.getElementById("collapseButton");

let collapsed = false;

const handleCollapse = () => {
    if(collapsed){
        content.classList.add("hidden");
    } else {
        content.classList.remove("hidden");
    }
    collapsed = !collapsed;
}

collapseButton.addEventListener("click", handleCollapse);

