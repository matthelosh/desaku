export const onHeaderStuck = (e) => {
    const header = document.querySelector('.main-nav')
    if (e) {
        header.style.height = '60px'
        header.style.transition = 'all .35s ease-in-out'
        header.style.boxShadow = '10px 0 30px lightblue!important'
    } else {
        header.style.height = '80px'
        header.style.transition = 'all .35s ease-in-out'
        header.style.boxShadow = 'none'
    }
}

export default { onHeaderStuck }