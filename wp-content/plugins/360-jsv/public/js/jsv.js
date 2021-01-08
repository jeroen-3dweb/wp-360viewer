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

    destroy() {
        if (this.jsv) {
            this.jsv.destroy();
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
                if (typeof val === 'string' && (val.toLowerCase() === 'true' || val.toLowerCase() === 'false')) {
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
        const parent = nodes[index].parentElement;
        if (!parent.classList.contains("360-viewer-ignore")) {
            window.JSV.items.push(new JsvInstance(nodes[index]));
        }
    }
});