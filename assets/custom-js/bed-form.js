const ul = document.querySelector("#beds");
const addButton = document.querySelector(".addBed");
const removeButtons = document.querySelectorAll(".removeBed");
const template = ul.dataset.template;


function onClickAdd() {
    const li = document.createElement("li");
    li.innerHTML = template.replace(
        /__name__/g,
        ul.dataset.index
    );
    ul.append(li);
    li.querySelector(".removeBed").addEventListener("click", onClickRemove);
    ul.dataset.index++;

}
addButton.addEventListener("click", onClickAdd);


function onClickRemove() {
    this.parentElement.remove();
}

for (const removeButton of removeButtons) {
    removeButton.addEventListener("click", onClickRemove);
}