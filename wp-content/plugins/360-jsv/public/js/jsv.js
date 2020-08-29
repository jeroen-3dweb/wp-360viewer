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

    getMainImageId(){

    }
    getMainHolderId(node){
      return node.id;
    }
    getData(node){
        let data = {};
        [].forEach.call(node.attributes, function(attr) {
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
        const data = this.getData(this.node)

        const jsv = new JavascriptViewer({
            mainHolderId: this.getMainHolderId(),
            mainImageId: this.getMainImageId(),
            totalFrames: data.totalFrames,
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
        window.JSV.items.push(new jsvInstance(a[index]));
    }
});
