window.JSVWoo = {
    items: [],
    errors: []
};

function createJsvWooInstance(generatedHtml, id) {
    const existing = window.JSVWoo.items.filter(instance => {
        return instance.idInProductGallery === id;
    })

    if (existing.length === 0) {

        // get items with class jsv-flatsome
        const jsvFlatsome = document.getElementsByClassName('jsv-flatsome');

        if (jsvFlatsome.length > 1) {
            // get the first item
            const firstItem = jsvFlatsome[0];

            //replace this node with generatedHtml
            firstItem.innerHTML = `<div id="${id}"> ${generatedHtml}</div>`;

            const node = document.getElementById(id). getElementsByClassName('jsv-holder') [0];

            // disable the pointerdown event on the parent node
            node.parentNode.addEventListener('pointerdown', (e) => {
                e.stopPropagation()
            });

            window.JSVWoo.items.push((new JsvInstance(node)));
        }
    }
}