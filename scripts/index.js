/** --------------------------------------------------------
 *
 *  @file index - qatar.com
 *  @copyright 2021
 *  @author penholder designerd
 *  @version 1.5.0
 *
 */
//--------------------------------------------------------
// package
import pkg from '../package.json'
//--------------------------------------------------------
// utils
import domReady from './utils/dom-ready'
//--------------------------------------------------------
// modules
import onScroll from './modules/scroll'
//import { mobileMenu } from './modules/header'
import featuredWidget from './modules/featured'
import store from './modules/store'
import addToCart from './modules/single-product'
import parallax from './modules/parallax'
import contact from './modules/contact'
import AOS from 'aos'

// core styles
import '../styles/index.scss'

//--------------------------------------------------------

domReady(() => {
   console.table({ ...theme, version: pkg.version })

   featuredWidget()
   onScroll()
   //mobileMenu()
   parallax()
   store()
   addToCart()
   contact()

   AOS.init({
      disable: 'mobile',
      offset: 200, // offset (in px) from the original trigger point
      delay: 0, // values from 0 to 3000, with step 50ms
      duration: 1000, // values from 0 to 3000, with step 50ms
      easing: 'ease-in-out', // default easing for AOS animations
      once: false, // whether animation should happen only once - while scrolling down
      mirror: false, // whether elements should animate out while scrolling past them
      anchorPlacement: 'top-bottom', // defines which position of the element regarding to window should trigger the animation
   })
})
//--------------------------------------------------------
