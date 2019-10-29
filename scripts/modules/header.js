export const ScrollHeader = () => {
   const header = document.querySelector('header.main-header')

   header && (checkWhite(header), window.addEventListener('scroll', () => checkWhite(header)))
}

const checkWhite = header => {
   window.pageYOffset > 250 ? header.classList.add('white') : header.classList.remove('white')
}

export const LangActions = () => {
   const chooser = document.querySelector('.lang-chooser')

   if (chooser) {
      const optionsList = chooser.querySelector('.language-chooser')
      const options = optionsList.querySelectorAll('li a')

      chooser.addEventListener('click', () => optionsList.classList.toggle('open'))

      for (let opt of options) {
         opt.addEventListener('click', () => optionsList.classList.toggle('open'))
      }
   }
}

export const MobileMenu = () => {
   const menu = document.querySelector('.mobile-menu')

   menu &&
      menu.addEventListener('click', e => {
         console.log('mobile')
         menu.classList.toggle('crossed')
         document.querySelector('#main-nav').classList.toggle('open')
         document.querySelector('.shadow').classList.toggle('visible')
      })
}
