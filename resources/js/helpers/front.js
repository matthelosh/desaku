export const onHeaderStuck = (e) => {
    const header = document.querySelector('.el-header')
    if (e) {
        header.style.height = '60px'
        header.style.transition = 'all .35s ease-in-out'
        // header.style.boxShadow = '10px 0 30px lightblue!important'
        header.classList.add('stuck')
    } else {
        header.style.height = '80px'
        header.style.transition = 'all .35s ease-in-out'
        header.classList.remove('stuck')
        // header.style.boxShadow = 'none'
    }
}

export default { onHeaderStuck }