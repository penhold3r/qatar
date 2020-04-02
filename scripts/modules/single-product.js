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
      console.log(btn)
      btn.addEventListener('mousedown', e => {
         e.target.classList.add('click')
      })
      btn.addEventListener('mouseup', e => {
         e.target.classList.remove('click')
      })
   })

   add.addEventListener('click', () => calcVal(input, 1))
   min.addEventListener('click', () => calcVal(input, -1))

}

const calcVal = (input, n) => {
   let val = parseInt(input.value)
   const newVal = val + n

   input.value = newVal >= 0 ? newVal : 0
}

export default addToCart;
