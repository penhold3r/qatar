const addToCart = () => {
	const form = document.querySelector('form.cart')

	form && formFunctions(form)
}

const formFunctions = form => {
	const btns = form.querySelectorAll('.qty-btn')
	const add = form.querySelector('.add')
	const min = form.querySelector('.minus')
	const input = form.querySelector('input.qty')

	btns.forEach(btn => {
		btn.addEventListener('mousedown', e => {
			e.target.classList.add('click')
		})
		btn.addEventListener('mouseup', e => {
			e.target.classList.remove('click')
		})
	})

	add.addEventListener('click', () => calcVal(input, 1))
	min.addEventListener('click', () => calcVal(input, -1))

	calcShipping(input)
}

const calcVal = (input, n) => {
	let val = parseInt(input.value)
	const newVal = val + n

	input.value = newVal >= 0 ? newVal : 0
}

const calcShipping = input => {
	const calcForm = document.querySelector('.calc-form')
	const prices = document.querySelector('.shipping-prices')
	const loading = document.querySelector('.loading')

	calcForm &&
		calcForm.addEventListener('submit', e => {
			const formData = new FormData(calcForm)
			const url = `${window.location.origin}/wp-content/plugins/woocommerce shipping carrier/epresis-single-shipping.php`

			e.preventDefault()

			if (formData.get('cp') === '') {
				calcForm.cp.focus()
				return
			}

			loading.style.display = 'inline-block'
			formData.append('cantidad', input.value)

			fetch(url, {
				method: 'POST',
				headers: {
					'Content-Type': 'application/x-www-form-urlencoded',
				},
				body: urlencodeFormData(formData),
			})
				.then(resp => resp.json())
				.then(data => {
					console.log('MEX DATA:', data[0])

					if (!data[0]) {
						const noCp = document.createElement('p')

						prices.style.display = 'none'
						//prices.querySelector('.shipping-price .value').innerHTML = ''
						//prices.querySelector('.shipping-total .value').innerHTML = ''

						noCp.classList.add('invalid-cp')

						noCp.setAttribute('data-aos', 'fadein')
						noCp.setAttribute('data-aos-offset', '-201')
						noCp.setAttribute('data-aos-delay', '50')

						noCp.innerHTML = `
                     <i class="icon fal fa-exclamation-circle"></i> 
                     <span>Código Postal inválido</span>
                  `
						prices.parentNode.insertBefore(noCp, prices.nextSibling)

						loading.style.display = 'none'

						return
					}

					const prevError = document.querySelector('.invalid-cp')

					const { productPrice } = calcForm.dataset

					const { price: shippingFee } = data[0]

					const shippingDisplay =
						typeof shippingFee === 'number' ? `$ ${shippingFee}` : shippingFee

					const totalDisplay =
						typeof shippingFee === 'number'
							? `$ ${(shippingFee + parseInt(productPrice)).toFixed(2)}`
							: productPrice

					prevError && prevError.remove()
					prices.style.display = 'block'
					prices.querySelector(
						'.shipping-price .value'
					).innerHTML = `<strong>${shippingDisplay}</strong>`
					prices.querySelector(
						'.shipping-total .value'
					).innerHTML = `<strong>${totalDisplay}</strong>`

					loading.style.display = 'none'
				})
				.catch(err => console.error('ERROR', err))
		})
}

const urlencodeFormData = fd => {
	let str = ''
	const encode = str => encodeURIComponent(str).replace(/%20/g, '+')
	for (const pair of fd.entries()) {
		if (typeof pair[1] == 'string') {
			str += (str ? '&' : '') + encode(pair[0]) + '=' + encode(pair[1])
		}
	}
	return str
}

export default addToCart
