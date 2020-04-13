/** --------------------------------------------------------
 *
 *  @file index - qatar.com
 *  @copyright 2020
 *  @author penholder designerd
 *  @version 1.0
 *
 */
//--------------------------------------------------------
// modules
import onScroll from './modules/scroll'
import { mobileMenu } from './modules/header'
import featuredWidget from './modules/featured'
import addToCart from './modules/single-product'
import parallax from './modules/parallax'
import AOS from 'aos'

// core styles
import '../styles/index.scss'

//--------------------------------------------------------
const domReady = callback => {
	document.readyState === 'interactive' || document.readyState === 'complete'
		? callback()
		: document.addEventListener('DOMContentLoaded', callback)
}

domReady(() => {
	console.log('-------> ready')
	console.table(theme)

	featuredWidget()
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
	})
})
//--------------------------------------------------------
