import simpleParallax from 'simple-parallax-js'

const parallax = () => {
	const images = document.querySelectorAll('.plx img')

	new simpleParallax(images, {
		orientation: 'down',
		scale: 1.5,
	})
}

export default parallax
