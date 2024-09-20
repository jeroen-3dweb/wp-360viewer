window.JSVWoo = {
    items: [],
    errors: []
};

function createJsvWooInstance(generatedHtml, id, generatedHtmlLarge) {
    const existing = window.JSVWoo.items.filter(instance => {
        return instance.idInProductGallery === id;
    })
    
    if (existing.length === 0) {
        window.JSVWoo.items.push(new JsvWooProductGalleryInstance(generatedHtml, id, generatedHtmlLarge));
    }
}

class JsvWooProductGalleryInstance {
    constructor(generatedHtml, id, generatedHtmlLarge) {
        this.idInProductGallery = id;
        this.generatedHtml = generatedHtml;
        this.generatedHtmlLarge = generatedHtmlLarge;

        this.jsvViewer = null;
        this.jsvViewerPopup = null;

        this.addIconAfterProductGallery(0);
        this.setEventsForPhotoSwipe(0);
    }

    setEventsForPhotoSwipe(tries) {
        if (document.getElementsByClassName('woocommerce-product-gallery__trigger').length === 0) {
            setTimeout(() => {
                if (tries < 10) {
                    this.setEventsForPhotoSwipe(tries++)
                }
            }, 100)
            return
        }
        jQuery('.pswp__button--arrow--right,.pswp__button--arrow--right,.woocommerce-product-gallery__trigger')
            .click(this._addPresentationInPhotoSwipe.bind(this))
    }

    _getPhotoSwipeFrame() {
        const div = document.createElement('div');
        div.style.margin = 'auto auto'
        div.className = 'woo-photoswipe-holder'
        return div;
    }

    _getPhotoSwipeMarginTop(photoSwipeWrapNode) {
        const otherSwipeNode = this._getPhotoSwipeNode(2);
        if(otherSwipeNode){
            return (otherSwipeNode.getBoundingClientRect().top - otherSwipeNode.offsetTop - otherSwipeNode.parentNode.offsetTop) /2;
        }

        return 0.1 * photoSwipeWrapNode.clientHeight;
    }

    _addPresentationInPhotoSwipe() {
        setTimeout(() => {
            const photoSwipeWrapNode = this._getPhotoSwipeNode(0)
            if (photoSwipeWrapNode) {

                const y = this._getPhotoSwipeMarginTop(photoSwipeWrapNode);

                let div = this._getPhotoSwipeFrame();
                div.innerHTML = this.generatedHtmlLarge;
                photoSwipeWrapNode.appendChild(div);

                photoSwipeWrapNode.style.paddingTop = `${y}px`

                for (let index = 0; index < photoSwipeWrapNode.childNodes.length; ++index) {
                    if (this.jsvViewerPopup) {
                        this.jsvViewerPopup.destroy();
                    }
                    this.jsvViewerPopup = (new JsvInstance(photoSwipeWrapNode.childNodes[index].childNodes[0]));
                    jQuery('.woo-photoswipe-holder').on('pointerdown', (e) => {
                        e.stopPropagation()
                    })
                }
            }
        }, 1000)
    }

    _getPhotoSwipeNode(nChildNodes) {
        const nodes = document.getElementsByClassName('pswp__zoom-wrap');
        for (let index = 0; index < nodes.length; ++index) {
            if (nodes[index].childNodes.length === nChildNodes) {
                return nodes[index];
            }
        }
        return null;
    }

    addIconAfterProductGallery(tries) {
        if (!document.getElementById(this.idInProductGallery)) {
            setTimeout(() => {
                if (tries < 10) {
                    this.addIconAfterProductGallery(tries++)
                }
            }, 100)
            return
        }

        const parent = document.getElementById(this.idInProductGallery);
        parent.innerHTML = this.generatedHtml;
        parent.className = '360-viewer-ignore';
   
        parent.addEventListener('touchstart', (e) => {
            e.stopPropagation()
        })
        for (let index = 0; index < parent.children.length; ++index) {
            if (this.jsvViewer) {
                this.jsvViewer.destroy();
            }
            this.jsvViewer = (new JsvInstance(parent.children[index]));
        }
    }
}