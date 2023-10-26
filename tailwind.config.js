import colors from 'tailwindcss/colors'
import forms from '@tailwindcss/forms'
import typography from '@tailwindcss/typography'

 

export default {
    content: ['./resources/**/*.blade.php', './vendor/filament/**/*.blade.php'],
    theme: {
        extend: {
            colors: {
                danger: colors.red,
                gray: colors.slate,
                info: colors.blue,
                primary: colors.indigo,
                success: colors.emerald,
                warning: colors.orange,


            },
       
        },
    },
    plugins: [forms, typography],
}
