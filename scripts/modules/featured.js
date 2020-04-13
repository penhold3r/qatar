const featuredWidget = () => {
	const featured = document.querySelector('.featured')

	featured && initWidget(featured)
}

const initWidget = featured => {
	const cards = featured.querySelectorAll('.featured-card')

	let currTop = 1
	setInterval(() => {
		cards.forEach(card => {
			card.classList.remove('active')
			card.style.zIndex = 0
		})
		cards[currTop].classList.add('active')
		cards[currTop].style.zIndex = cards.length + 1
		currTop = currTop === cards.length - 1 ? 0 : currTop + 1
	}, 6500)
}

export default featuredWidget
