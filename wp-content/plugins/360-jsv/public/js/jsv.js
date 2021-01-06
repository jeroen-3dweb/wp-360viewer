/* global JSV:[] */
class JsvInstance {
    constructor(node) {
        this.data = this.getData(node);
        this.mainHolderId = this.getMainHolderId(node);
        this.mainImageId = this.getMainImageId(node);
        if (window.JavascriptViewer !== undefined) {
            this.jsv = new JavascriptViewer(this.data);
            this.jsv.start()
                .then()
                .catch((reason => console.warn(reason)));
        } else {
            console.warn('JavascriptViewer is not loaded');
        }
    }

    getMainImageId(node) {
        return node.getElementsByTagName('img')[0].id;
    }

    getMainHolderId(node) {
        return node.id;
    }

    getData(node) {
        let data = {};

        const camelCase = (function () {
            const DEFAULT_REGEX = /[-_]+(.)?/g;

            function toUpper(match, group1) {
                return group1 ? group1.toUpperCase() : '';
            }

            return function (str, delimiters) {
                return str.replace(delimiters ?
                    new RegExp('[' + delimiters + ']+(.)?', 'g') :
                    DEFAULT_REGEX, toUpper);
            };
        })();

        [].forEach.call(node.attributes, function (attr) {
            if (/^data-/.test(attr.name)) {
                let val = parseInt(attr.value) || attr.value;
                val = val.toString().length === attr.value.length ? val : attr.value;
                if(typeof val === 'string' && (val.toLowerCase() === 'true' || val.toLowerCase() === 'false')){
                    val = val.toLowerCase() === 'true'
                }
                data[camelCase(attr.name.substr(5), '-')] = val;
            }
        });
        return data;
    }
}

// Initialize the container for referencing the viewer.
window.JSV = {
    items: [],
    errors: []
};

// Search for presentations.
window.addEventListener('load', () => {
    const nodes = document.getElementsByClassName('jsv-holder');
    for (let index = 0; index < nodes.length; ++index) {
        window.JSV.items.push(new JsvInstance(nodes[index]));
    }


    // override photoswipe
    // overridePhotoSwipe()
});



function loadjsv(code, id, large){
    console.log('jsv loaded in div', code, id);
    setTimeout(() => {
        const parent = document.getElementById(id);
        parent.innerHTML = code;
        setTimeout(()=> {
            for (let index = 0; index < parent.childNodes.length; ++index) {
                window.JSV.items.push(new JsvInstance(parent.childNodes[index]));
            }
        }, 200)

        loadAnimation = function (){
           const existing = document.getElementById('360-slide');
           if(existing && existing.childNodes.length > 0){
               existing.removeChild(existing.childNodes[0])
           }
            setTimeout(()=>{
                const nodes =  document.getElementsByClassName('pswp__item');
                for (let index = 0; index < nodes.length; ++index) {
                    if(nodes[index].childNodes.length === 1){
                        if(nodes[index].childNodes[0].childNodes.length === 0) {
                            // nodes[index].parentElement.removeChild(nodes[index])
                        }
                        // nodes[index].id = "360-slide";
                        // nodes[index].innerHTML = large;
                        // setTimeout(()=> {
                        //     window.JSV.items.push(new JsvInstance(nodes[index].childNodes[0]));
                        // }, 200);
                    }
                }
            }, 200)
        }
        //
        // const trigger =  document.getElementsByClassName('woocommerce-product-gallery__trigger');
        // if(trigger.length > 0){
        //     trigger[0].addEventListener('click',  loadAnimation)
        // }
        //
        // const triggerButtonsLeft =  document.getElementsByClassName('pswp__button--arrow--left');
        // if(triggerButtonsLeft.length > 0){
        //     triggerButtonsLeft[0].addEventListener('click',  loadAnimation)
        // }
        //
        // const triggerButtons =  document.getElementsByClassName('pswp__button--arrow--right');
        // if(triggerButtons.length > 0){
        //     triggerButtons[0].addEventListener('click',  loadAnimation)
        // }


    }, 2000)





}