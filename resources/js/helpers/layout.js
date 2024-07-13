export const lebar = () => {
    let width = window.innerWidth
    return width > 1024 ? 'lg' : (width > 768 ? 'md' : (width > 414 ? 'sm' : 'xs'))
}

export default { lebar }