import { registerBlockType } from '@wordpress/blocks'
import { useBlockProps } from '@wordpress/block-editor'
import {
  __experimentalText as Text,
  Card,
  CardBody,
  CardFooter,
  CardHeader, CheckboxControl,
  Flex,
  FlexItem,
  TextareaControl, TextControl,
} from '@wordpress/components'
import ShortCode from './ShortCode'

registerBlockType('jsviewer/default-viewer', {
  icon: {
    src: <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 250 250"
              enableBackground="new 0 0 512 512">
      <g>
        <g fill="#a0a5aa">
          <path
            d="m105.46 1.5998c28.676 0 54.644 11.628 73.434 30.418 18.794 18.794 30.422 44.758 30.422 73.434 0 28.68-11.628 54.644-30.422 73.438-18.794 18.794-44.758 30.422-73.434 30.422-28.68 0-54.644-11.628-73.438-30.422-18.79-18.79-30.418-44.758-30.418-73.438 0-28.676 11.624-54.64 30.418-73.434 18.794-18.794 44.758-30.418 73.438-30.418zm66.873 36.982c-17.112-17.116-40.759-27.698-66.873-27.698-26.118 0-49.761 10.582-66.873 27.698-17.112 17.112-27.698 40.755-27.698 66.87 0 26.118 10.586 49.761 27.698 66.877 17.112 17.112 40.755 27.698 66.873 27.698 26.114 0 49.761-10.586 66.873-27.698 17.112-17.116 27.698-40.759 27.698-66.877 0-26.114-10.586-49.757-27.698-66.87"/>
          <path
            d="m179.1 153.95c-2.2571 6.2408-12.064 15.894-18.339 20.822-38.254 30.045-90.569 25.05-122.36-11.515-11.244-12.933-21.758-36.723-20.551-54.049 8.37 8.9831 28.187 15.709 40.116 19.189 39.066 11.394 99.458 11.921 135.27-19.174 0.13542 4.202-3.9048 11.684-7.0834 16.059-20.156 27.739-56.848 35.15-88.383 33.081-19.49-1.2791-28.055-5.4697-33.766-6.2672 7.7079 6.4101 24.312 9.8596 33.551 11.406l21.077 1.7718c42.305-0.43294 50.506-8.0691 60.467-11.323"
            fillRule="evenodd"/>
          <path
            d="m32.371 88.572c25.731 11.345 40.729 14.487 69.71 12.621 17.47-1.1248 38.013-6.2295 55.55-16.157 22.804-14.475 18.147-25.7 19.456-31.339 21.559 41.071-44.506 71.053-77.008 70.575-33.668 0.67285-52.15-4.4879-82.297-16.059-0.79762-11.692 2.7686-30.045 8.0804-41.007 22.247-45.932 78.117-62.517 118.93-41.974 7.106 3.5776 19.377 10.492 22.469 20.953 8.6371 29.195-48.813 45.089-67.934 47.538-27.028 3.4646-41.432 0.12049-66.952-5.1499"
            fillOpacity=".48" fillRule="evenodd"/>
        </g>
      </g>
    </svg>
  },
  attributes: {
    code: {
      type: 'string',
      default: '[360-jsv total-frames=72 main-image-url=https://cdn1.360-javascriptviewer.com/images/blue-shoe-small/20180906-001-blauw.jpg image-url-format=20180906-0xx-blauw.jpg speed=90 inertia=12 zoom=true reverse=true auto-rotate=1 notification-config_drag-to-rotate_show-start-to-rotate-default-notification=true ]',
      source: 'text'
    },
    useWooCommerceProduct: {
      type: 'boolean',
      default: false,
    },
    useACFProduct: {
      type: 'boolean',
      default: false,
    },
    reference: {
      type: 'string',
      default: '',
    }
  },
  edit: (props) => {
    return <div {...useBlockProps()}><Card>
      <CardHeader>
        <Flex align>
          <FlexItem height="50px">
            <svg height="50px" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 250 250"
                 enableBackground="new 0 0 512 512">
              <g>
                <g fill="#a0a5aa">
                  <path
                    d="m105.46 1.5998c28.676 0 54.644 11.628 73.434 30.418 18.794 18.794 30.422 44.758 30.422 73.434 0 28.68-11.628 54.644-30.422 73.438-18.794 18.794-44.758 30.422-73.434 30.422-28.68 0-54.644-11.628-73.438-30.422-18.79-18.79-30.418-44.758-30.418-73.438 0-28.676 11.624-54.64 30.418-73.434 18.794-18.794 44.758-30.418 73.438-30.418zm66.873 36.982c-17.112-17.116-40.759-27.698-66.873-27.698-26.118 0-49.761 10.582-66.873 27.698-17.112 17.112-27.698 40.755-27.698 66.87 0 26.118 10.586 49.761 27.698 66.877 17.112 17.112 40.755 27.698 66.873 27.698 26.114 0 49.761-10.586 66.873-27.698 17.112-17.116 27.698-40.759 27.698-66.877 0-26.114-10.586-49.757-27.698-66.87"/>
                  <path
                    d="m179.1 153.95c-2.2571 6.2408-12.064 15.894-18.339 20.822-38.254 30.045-90.569 25.05-122.36-11.515-11.244-12.933-21.758-36.723-20.551-54.049 8.37 8.9831 28.187 15.709 40.116 19.189 39.066 11.394 99.458 11.921 135.27-19.174 0.13542 4.202-3.9048 11.684-7.0834 16.059-20.156 27.739-56.848 35.15-88.383 33.081-19.49-1.2791-28.055-5.4697-33.766-6.2672 7.7079 6.4101 24.312 9.8596 33.551 11.406l21.077 1.7718c42.305-0.43294 50.506-8.0691 60.467-11.323"
                    fillRule="evenodd"/>
                  <path
                    d="m32.371 88.572c25.731 11.345 40.729 14.487 69.71 12.621 17.47-1.1248 38.013-6.2295 55.55-16.157 22.804-14.475 18.147-25.7 19.456-31.339 21.559 41.071-44.506 71.053-77.008 70.575-33.668 0.67285-52.15-4.4879-82.297-16.059-0.79762-11.692 2.7686-30.045 8.0804-41.007 22.247-45.932 78.117-62.517 118.93-41.974 7.106 3.5776 19.377 10.492 22.469 20.953 8.6371 29.195-48.813 45.089-67.934 47.538-27.028 3.4646-41.432 0.12049-66.952-5.1499"
                    fillOpacity=".48" fillRule="evenodd"/>
                </g>
              </g>
            </svg>
          </FlexItem>
          <FlexItem>
            <h5>360 Javascript Viewer</h5>
          </FlexItem>
        </Flex>
      </CardHeader>
      <CardBody>
        <TextareaControl
          label={'Enter shortcode'}
          onChange={(value) => props.setAttributes({ code: value })}
          value={props.attributes.code}
        />
        
        <TextControl
          label={'Enter reference'}
          help={'It can be useful if you need to acces the viewer from your website.'}
          onChange={(value) => props.setAttributes({ reference: value })}
          value={props.attributes.reference}
        />
        
        <CheckboxControl
          label="Use WooCommerce Product if there is one"
          help="It will override the default code."
          checked={props.attributes.useWooCommerceProduct}
          onChange={(value) => props.setAttributes({ useWooCommerceProduct: value })}
        />
        
        <CheckboxControl
          label="Use ACF Field if there is one"
          help="It will override the default code."
          checked={props.attributes.useACFProduct}
          onChange={(value) => props.setAttributes({ useACFProduct: value })}
        />
        
        <p>You can find the shortcode on <a className="is_link" target="_blank"
                                            href="https://www.360-javascriptviewer.com/wordpress?utm_source=wordpress&utm_medium=gutenberg&utm_campaign=plugin">360-javascriptviewer.com </a>
          or on <a target="_blank"
                   href="https://3dweb.io/?utm_source=wordpress&utm_medium=gutenberg&utm_campaign=plugin">3DWeb.io</a>
          <br/>
          Check for more examples on <a target="_blank"
                                        href="https://wordpress.360-javascriptviewer.com?utm_source=wordpress&utm_medium=gutenberg&utm_campaign=plugin">wordpress.360-javascriptviewer.com</a>
        </p>
      </CardBody>
      <CardFooter>
        <Text>The shortcode is placed into the source. Then it will be converted to a 360 presentation.</Text>
      </CardFooter>
    </Card>
    </div>
    
  },
  save: (props) => {
    return <div>{props.attributes.code}</div>
  }
})