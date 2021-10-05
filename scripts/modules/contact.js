import submitFormData from '../utils/submit-form'

const contact = () => {
	const form = document.querySelector('.contact-form')

	const settings = {
		dest: theme.themeURL + '/contact-form.php',
		fields: '.form-field',
		reciever: 'penhold3r@gmail.com',
	}

	if (form) {
		const { validate, send } = submitFormData(form, settings)

		console.log(validate, send)

		form.addEventListener('submit', e => {
			e.preventDefault()

			const msg = form.querySelector('.output-msg')
			const { valid, field } = validate()

			if (valid) {
				msg.querySelector('p').innerHTML = 'Sending...'
				msg.classList.add('visible')

				send()
					.then(({ ok, data }) => ok && contactResp(msg, data.name, ok))
					.catch(({ ok, data, valid }) => {
						console.error(data)
						valid && contactResp(msg, data.name, ok)
					})
			} else {
				//console.log(valid, field)
			}
		})
	}
}

const contactResp = (msg, name, ok) => {
	const msgClose = document.createElement('div')
	const txt = ok
		? `${name}, gracias por comunicarte con nosotros, te responderemos a la brevedad.`
		: `${name}, algo parece haber salido mal, intenta luego más tarde.`

	msgClose.classList.add('close-form-msg')
	msgClose.innerHTML = 'Enviar otro mensaje'
	msg.appendChild(msgClose)
	msgClose.addEventListener('click', e => msg.classList.remove('visible'))

	msg.querySelector('p').innerHTML = txt
	msg.classList.add('visible')

	msg.querySelector('p').className = ok ? 'msg-ok' : 'msg-error'
}

export default contact
