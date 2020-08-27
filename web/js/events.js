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

function changeSlideClickEvent (event, direction) {
    let galleyImagesCollection = document.getElementsByClassName("galery-image");

    let collectionArray,collectionIndex,activeKey;

    collectionArray = Array.from(galleyImagesCollection);
    collectionIndex = collectionArray.map((item) => {
        return item.classList.contains("active");
    });
    activeKey = collectionIndex.indexOf(true);

    collectionArray[activeKey].classList.remove("active");
    switch (direction) {
        case "next": {
            if(activeKey === (collectionArray.length - 1)) {
                let el = collectionArray[0];
                let eId = el.id;

                el.classList.add("active");
                updateLinks(eId);
            } else if (collectionArray[activeKey+1] !== undefined) {
                let el = collectionArray[activeKey+1];
                let eId = el.id;

                el.classList.add("active");
                updateLinks(eId);
            }
            break;
        }
        case "prev": {
            if(activeKey === 0) {
                let el = collectionArray[collectionArray.length - 1];
                let eId = el.id;

                el.classList.add("active");
                updateLinks(eId);
            } else if (collectionArray[activeKey-1] !== undefined) {
                let el = collectionArray[activeKey-1];
                let eId = el.id;

                el.classList.add("active");
                updateLinks(eId);
            }
            break;
        }
    }
}

function updateLinks(id) {
    let downloadLink, removeLink;

    downloadLink = "/folder/download-file?file_id="+id;
    removeLink = "/folder/remove-file?file_id="+id;

    const removeButtonElement = document.getElementById("gallery-remove");
    const downloadButtonElement = document.getElementById("gallery-download");
    console.log(id)

    removeButtonElement.href = removeLink;
    downloadButtonElement.href = downloadLink;
}

function imageSelectedEvent(e, image_id) {
    let galleyImagesCollection = document.getElementsByClassName("galery-image");
    let collectionArray = Array.from(galleyImagesCollection);

    collectionArray.forEach((item) => {
        if(item.id == image_id) {
            item.classList.add('active')
            updateLinks(item.id)
        } else if (item.classList.contains("active")) {
            item.classList.remove('active')
        }
    })
}