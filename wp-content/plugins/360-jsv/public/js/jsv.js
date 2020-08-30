// Find all the nodes with class .jsv

//  For each node create a new viewer and add them in window.jsvholder
// Read data from data container

class jsvInstance {

    constructor(node) {
        this.data = this.getData(node);
        this.mainHolderId = this.getMainHolderId(node);
        this.mainImageId = this.getMainImageId(node);

        this.run();
    }

    getMainImageId(node) {
        return node.getElementsByTagName('img')[0].id;
    }

    getMainHolderId(node) {
        return node.id;
    }

    getData(node) {
        let data = {};

        var camelCase = (function () {
            var DEFAULT_REGEX = /[-_]+(.)?/g;

            function toUpper(match, group1) {
                return group1 ? group1.toUpperCase() : '';
            }
            return function (str, delimiters) {
                return str.replace(delimiters ? new RegExp('[' + delimiters + ']+(.)?', 'g') : DEFAULT_REGEX, toUpper);
            };
        })();

        [].forEach.call(node.attributes, function (attr) {
            if (/^data-/.test(attr.name)) {
                data[camelCase(attr.name.substr(5), '-')] = attr.value;
            }
        });
        return data;
    }

    run() {
        const jsv = new JavascriptViewer(this.data);
       jsv.start();
    }

}

//  Initialize the container for referencing the viewer
window.JSV = {
    items: [],
    errors: []
};

//  Search for presentations
window.addEventListener('load', () => {
    const nodes = document.getElementsByClassName("jsv-holder");
    for (let index = 0; index < nodes.length; ++index) {
        window.JSV.items.push(new jsvInstance(nodes[index]));
    }
});
