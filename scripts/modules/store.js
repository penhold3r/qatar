import imageLoaded from '../utils/image-loaded'

const store = () => {
	const grid = document.querySelector('ul.products')

	grid && fadeImages(grid)
}

const fadeImages = grid => {
	const imgs = grid.querySelectorAll('.feat-img')

	imgs.forEach(img =>
		imageLoaded(img.querySelector('.feat-img-file'), () => img.classList.add('loaded'))
	)
}

export default store
