export default function({ isHMR, store }) {
    // If middleware is called from hot module replacement, ignore it
    if (isHMR) return;

    // get logged user
    return store.dispatch('logged-user/getUser').catch(() => {
        // avoid error page
    });
}