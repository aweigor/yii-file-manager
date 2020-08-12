class Form {

    constructor(pageElements) {
        this.pageElements = [
            {
                position: "head",
                element: pageElements.head || ""
            },
            {
                position: "body",
                element: pageElements.body || ""
            },
            {
                position: "bottom",
                element: pageElements.bottom || ""
            }
        ];

        this.responseHTML = this.responseHTML || null;
        this.formDOM = this.formDOM|| null;
        this.formElements = this.formElements || {
            submitButton: null,
            form: null
        };
    }

    BindSubmitEvent(formId, actionName, options = {}) {
        const that = this;
        let submitButton, form, formData, requestBody;
        submitButton = document.getElementById("ajax-form-submit");
        form = document.getElementById(formId);

        submitButton.addEventListener("click", function(event) {
            event.preventDefault();

            options.formData = JSON.stringify($(form).serializeArray());
            jQuery
                .post( "/ajax/"+actionName, options)
                .done( function( data )
                {
                    let response = JSON.parse(data) || {};
                    if  (response.status !== "success") {
                        that.ParseDOM(response)
                            .then( (result) =>
                            {
                                that.InsertAsHtml()
                                    .then( (result) =>
                                    {
                                        that.BindSubmitEvent(formId, actionName)
                                    })
                            })
                    }
                })
        })
    };

    InsertAsHtml = function() {
        const html = this.responseHTML;

        return new Promise( (resolve) => {
            this.pageElements.forEach(function(item, key, self) {
                item.element.innerHTML = html[item.position]
                if(key === self.length - 1) {
                    resolve("done")
                }
            });
        } );
    };

    ParseDOM = function(response) {

        this.responseHTML = response.html;

        this.formDOM = new DOMParser().parseFromString(response.html.body, "text/html");
        this.formElements.submitButton = this.formDOM.getElementById("ajax-form-submit") || null;
        this.formElements.form = this.formDOM.getElementById("ajax-form-body") || null;

        return new Promise( (resolve,reject) => {
            if(this.formElements.submitButton && this.formElements.form) {
                resolve("done")
            }
        } );
    };

    NewFolderForm = function() {
        const that = this;
        this.GetForm("folder")
            .then( (response) =>
            {
                that.ParseDOM(response)
                .then( (result) =>
                {
                    that.InsertAsHtml()
                    .then( (result) =>
                    {
                        that.BindSubmitEvent("new-folder-form", "folder")
                    })
                })
            });
        return this;
    };

    EditFolderForm = function(folder_id) {
        const that = this;
        this.GetForm("folder", {folder_id: folder_id})
            .then( (response) =>
            {
                that.ParseDOM(response)
                    .then( (result) =>
                    {
                        that.InsertAsHtml()
                            .then( (result) =>
                            {
                                that.BindSubmitEvent("edit-folder-form", "folder", {folder_id:folder_id})
                            })
                    })
            });
        return this;
    };

    EditFileForm (file_id) {
        const that = this;
        this.GetForm("file-edit", {file_id:file_id})
            .then( (response) =>
            {
                that.ParseDOM(response)
                    .then( (result) =>
                    {
                        that.InsertAsHtml()
                            .then( (result) =>
                            {
                                that.BindSubmitEvent("edit-file-form", "file-edit", {file_id:file_id})
                            })
                    })
            });
        return this;
    }

    GetForm = function(formType, options = {}) {
        return new Promise((resolve) => {
            jQuery
                .get( "/ajax/"+formType, options)
                .done( function( data )
                {
                    let response = JSON.parse(data) || {};
                    resolve(response)
                })
        });
    }
}

jQuery(document).ready ( function() {
    const pageElements = {
        head: document.getElementById("ajax-content-head") || null,
        body: document.getElementById("ajax-content-body") || null,
        bottom: document.getElementById("ajax-content-bottom") || null
    };

    const btAddFolder = document.getElementById("bt-add-folder") || null;
    const btEditFolderCollection = document.getElementsByClassName("bt-edit-folder") || null;
    const btEditFileCollection = document.getElementsByClassName("bt-edit-file") || null;

    if(btEditFileCollection) {
        for(let btEditFileElement of btEditFileCollection) {
            const file_id = btEditFileElement.id.split("_")[1];
            btEditFileElement.addEventListener("click", function() {
                return new Form ( pageElements ).EditFileForm(file_id)
            })
        }
    }

    if(btAddFolder) {
        btAddFolder.addEventListener("click", function() {
            return new Form ( pageElements ).NewFolderForm()
        })
    }

    if(btEditFolderCollection) {
        for(let btEditFolderElement of btEditFolderCollection) {
            const folder_id = btEditFolderElement.id.split("_")[1];
            btEditFolderElement.addEventListener("click", function() {
                return new Form ( pageElements ).EditFolderForm(folder_id)
            })
        }
    }
});