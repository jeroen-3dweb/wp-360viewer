/* global JSV:[] */
class JsvInstance {
  constructor (node) {
    this.data = this.getData(node)
    if (window.JavascriptViewer !== undefined && Object.keys(this.data).length !== 0) {
      this.mainHolderId = this.getMainHolderId(node)
      this.mainImageId = this.getMainImageId(node)
      this.jsv = new JavascriptViewer(this.data)
      this.jsv.start()
        .then(() => {
          const elements = document.getElementsByClassName('360-viewer-ignore')
          for (let element of elements) {
            element.addEventListener('click', (e) => {
              e.stopPropagation()
              e.preventDefault()
            })
          }
        })
        .catch((reason => console.warn(reason)))
    } else {
      console.warn('JavascriptViewer is not loaded')
    }
  }
  
  destroy () {
    if (this.jsv) {
      this.jsv.destroy()
    }
  }
  
  getMainImageId (node) {
    return node.getElementsByTagName('img')[0].id
  }
  
  getMainHolderId (node) {
    return node.id
  }
  
  deepen (obj) {
    const result = {}
    
    // For each object path (property key) in the object
    for (const objectPath in obj) {
      // Split path into component parts
      const parts = objectPath.split('_')
      
      // Create sub-objects along path as needed
      let target = result
      while (parts.length > 1) {
        const part = parts.shift()
        target = target[this.camelCase(part)] = target[part] || {}
      }
      
      // Set value at end of path
      target[this.camelCase(parts[0])] = obj[objectPath]
    }
    
    return result
  }
  
  camelCase (str) {
    const delimiters = '-'
    const DEFAULT_REGEX = /[-_]+(.)?/g
    
    const toUpper = (match, group1) => {
      return group1 ? group1.toUpperCase() : ''
    }
    return str.replace(delimiters ?
      new RegExp('[' + delimiters + ']+(.)?', 'g') :
      DEFAULT_REGEX, toUpper)
  };
  
  getData (node) {
    let data = {}
    
    if (typeof node.attributes !== 'undefined') {
      [].forEach.call(node.attributes, (attr) => {
        if (/^data-/.test(attr.name)) {
          let val = parseInt(attr.value) || attr.value
          val = val.toString().length === attr.value.length ? val : attr.value
          if (typeof val === 'string' && (val.toLowerCase() === 'true' || val.toLowerCase() === 'false')) {
            val = val.toLowerCase() === 'true'
          }
          
          data[this.camelCase(attr.name.substr(5), '-')] = val
          
        }
      })
    }
    
    return this.deepen(data)
  }
}

// Initialize the container for referencing the viewer.
window.JSV = {
  items: [],
  errors: []
}

// Search for presentations.
window.addEventListener('load', () => {
  window.JSV.run = (reference, cb) => {
    let found = false
    for (let index = 0; index < window.JSV.items.length; ++index) {
      if (window.JSV.items[index].mainHolderId === 'jsv-holder-' + reference) {
        cb.call(window.JSV.items[index].jsv, window.JSV.items[index].jsv)
        found = true
      }
    }
    if (!found) {
      window.JSV.errors.push('JSV with reference ' + reference + ' not found')
    }
  }
  const nodes = document.getElementsByClassName('jsv-holder')
  for (let index = 0; index < nodes.length; ++index) {
    const parent = nodes[index].parentElement
    if (!parent.classList.contains('360-viewer-ignore')) {
      window.JSV.items.push(new JsvInstance(nodes[index]))
    }
  }
})