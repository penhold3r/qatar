

export const mobileMenu = () => {
   const menu = document.querySelector('.hamb-menu')
   const sideNav = document.querySelector('.side-nav')

   menu &&
      menu.addEventListener('click', e => {
         console.log('mobile')
         menu.classList.toggle('crossed')
         sideNav.classList.toggle('expanded')
      })
}
