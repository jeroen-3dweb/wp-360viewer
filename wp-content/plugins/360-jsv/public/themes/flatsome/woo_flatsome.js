window.JSVWoo = {
    items: [],
    errors: []
};

function createJsvWooInstance(generatedHtml, id, run) {
    const existing = window.JSVWoo.items.filter(instance => {
        return instance.idInProductGallery === id;
    })

    if (existing.length === 0) {

        const jsvFlatsome = document.getElementsByClassName('jsv-flatsome');

        if (jsvFlatsome.length > 1) {
            // get the first item
            const firstItem = jsvFlatsome[0];

            //replace this node with generatedHtml
            firstItem.innerHTML = `<div id="${id}"> ${generatedHtml}</div>`;

            const node = document.getElementById(id).getElementsByClassName('jsv-holder') [0];

            // disable the pointerdown event on the parent node
            node.parentNode.addEventListener('pointerdown', (e) => {
                e.stopPropagation()
            });

            if (run) {
                const instance = new JsvInstance(node);
                instance.jsv.events().started.on((boolean) => {
                    // navigation arrows
                    const hideElements = document.getElementsByClassName('flickity-prev-next-button');
                    for (let i = 0; i < hideElements.length; i++) {
                        hideElements[i].style.display = 'none';
                    }

                    const classObserver = new MutationObserver(function (mutations) {
                        mutations.forEach(function (mutation) {
                            if (mutation.attributeName === "style") {
                                if (node.parentNode.parentNode.parentNode.classList.contains('is-selected')) {

                                    const newHeight = node.clientHeight;
                                    document.querySelector('.flickity-viewport').style.height = `${newHeight}px`;


                                }
                            }
                        });
                    });

                    classObserver.observe(document.getElementsByClassName('flickity-viewport')[0], {
                        attributes: true,
                    });

                })
                window.JSVWoo.items.push(instance);
            }
        }
    }
}