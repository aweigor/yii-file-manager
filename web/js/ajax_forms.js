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

    BindSubmitEvent(formBody, action ) {
        const that = this
        let submitButton = document.getElementById("ajax-form-submit");
        let form = document.getElementById("new-folder-form");

        submitButton.addEventListener("click", function(event) {
            event.preventDefault();

            let data = $(form).serializeArray();

            console.log(data);

            jQuery
                .post( "/ajax/new-folder", JSON.stringify(data))
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
                                        that.BindSubmitEvent()
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

        console.log(response)

        this.responseHTML = response.html;

        this.formDOM = new DOMParser().parseFromString(response.html.body, "text/html");
        this.formElements.submitButton = this.formDOM.getElementById("ajax-form-submit") || null;
        this.formElements.form = this.formDOM.getElementById("ajax-form-body") || null;

        console.log(this.formElements)

        return new Promise( (resolve,reject) => {
            if(this.formElements.submitButton && this.formElements.form) {
                resolve("done")
            }
        } );
    }

    NewFolderForm = function() {
        const that = this;
        this.GetForm("new-folder")
            .then( (response) =>
            {
                that.ParseDOM(response)
                .then( (result) =>
                {
                    that.InsertAsHtml()
                    .then( (result) =>
                    {
                        that.BindSubmitEvent()
                    })
                })
            });
        return this;
    };

    GetForm = function(formType) {
        switch(formType) {
            case("new-folder"): {
                return new Promise((resolve) => {
                    jQuery
                        .get( "/ajax/new-folder")
                        .done( function( data )
                        {
                            let response = JSON.parse(data) || {};
                            resolve(response)
                        })
                });
            }
        }
    }
}

jQuery(document).ready ( function() {
    const pageElements = {
        head: document.getElementById("ajax-content-head") || {},
        body: document.getElementById("ajax-content-body") || {},
        bottom: document.getElementById("ajax-content-bottom") || {}
    };

    const btAddFolder = document.getElementById("bt-add-folder") || {};

    if(btAddFolder) {
        btAddFolder.addEventListener("click", function() {
            return new Form ( pageElements ).NewFolderForm()
        })
    }
});