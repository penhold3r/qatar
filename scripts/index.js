/** --------------------------------------------------------
 *
 *  @file index - qatar.com
 *  @copyright 2019
 *  @author penholder designerd
 *  @version 1.0
 *
 */
//--------------------------------------------------------
// modules
import onScroll from './modules/scroll'
import { mobileMenu } from './modules/header'
import addToCart from './modules/single-product'
import parallax from './modules/parallax'
import AOS from 'aos';
// core styles
import 'sanitize.css'
import 'aos/dist/aos.css'
import '../styles/index.scss'
//--------------------------------------------------------
//>>     DOM READY
/**
 * @param {Function} callback - function to call after DOM is ready
 */
//--------------------------------------------------------
const domReady = callback => {
   document.readyState === 'interactive' || document.readyState === 'complete'
      ? callback()
      : document.addEventListener('DOMContentLoaded', callback)
}

/**
 * @callback Qatar - callback function of deomReady()
 */
const Qatar = () => {
   console.log('-------> init')
   console.log(JSON.stringify(theme, null, 2))

   onScroll()
   mobileMenu()
   parallax()
   addToCart()

   AOS.init({

      offset: 200, // offset (in px) from the original trigger point
      delay: 0, // values from 0 to 3000, with step 50ms
      duration: 1000, // values from 0 to 3000, with step 50ms
      easing: 'ease-in-out', // default easing for AOS animations
      once: false, // whether animation should happen only once - while scrolling down
      mirror: false, // whether elements should animate out while scrolling past them
      anchorPlacement: 'top-bottom', // defines which position of the element regarding to window should trigger the animation

   });
}

domReady(Qatar)
//--------------------------------------------------------
