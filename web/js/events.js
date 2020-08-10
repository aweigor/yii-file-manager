function editGroupMouseOver (event) {

    if(event.relatedTarget.className === "edit_bt_group" || event.relatedTarget.className.includes('fas')) return;

    let edtGroupTarget, editGroupElements;
    const parent = event.target.parentElement;

    event.target.classList.add("hovered");
    editGroupElements = parent.getElementsByClassName("edit_bt_group");

    if(editGroupElements.length) {
        edtGroupTarget = editGroupElements[0];
        edtGroupTarget.classList.remove("d-none");
    }
}

function editGroupMouseOut (event) {

    if(event.relatedTarget.className === "edit_bt_group" || event.relatedTarget.className.includes('fas')) return;

    let edtGroupTarget, editGroupElements;
    const parent = event.target.parentElement;

    event.target.classList.remove("hovered");
    editGroupElements = parent.getElementsByClassName("edit_bt_group");

    if(editGroupElements.length) {
        edtGroupTarget = editGroupElements[0];
        edtGroupTarget.classList.add("d-none");
    }
}

function folderClickEvent (url) {
    return window.location.href = url;
}