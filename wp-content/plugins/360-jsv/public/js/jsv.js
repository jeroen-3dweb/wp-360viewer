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
        [].forEach.call(node.attributes, function (attr) {
            if (/^data-/.test(attr.name)) {
                var camelCaseName = attr.name.substr(5).replace(/-(.)/g, function ($0, $1) {
                    return $1.toUpperCase();
                });
                data[camelCaseName] = attr.value;
            }
        });
        return data;
    }

    run() {

        const jsv = new JavascriptViewer({
            mainHolderId: this.mainHolderId,
            mainImageId: this.mainImageId,
            totalFrames: this.data.totalFrames,
            defaultProgressBar: true,
            speed: 90,
            inertia: 12
        });

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
