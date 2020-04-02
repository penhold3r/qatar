const onScroll = () => {
	check()
	window.onscroll = () => check()
}

const check = () => {
	const header = document.querySelector('.site-header')
	const nav = document.querySelector('.navigation')
	const hamb = document.querySelector('.hamb-menu')

	let hambOpacity, navLeft

	hambOpacity = window.scrollY / 4 / 100
	navLeft = window.scrollY / 1.5

	//nav.style.left = `-${navLeft}px`
	//hamb.style.opacity = hambOpacity

	window.scrollY >= 300 ? header.classList.add('opaque') : header.classList.remove('opaque')
}

export default onScroll
