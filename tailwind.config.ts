import {Config} from 'tailwindcss'
export default <Config>{
  darkMode: ['class'],
  /* Extend the Tailwind config here */
  content: [
    './client/content/**/**.md',
    './client/assets/**/*.css',
    './client/components/*.{vue,js}',
    './client/components/**/*.{vue,js}',
    './client/pages/*.vue',
    './client/pages/**/*.vue',
    './client/plugins/**/*.{js,ts}',
    './client/*.{vue,js,ts}',
  ],
  daisyui: {
    rtl: true,
    themes: [
      {
        dark: {
          primary: '#FCA311',
          secondary: '#14213d',
          accent: '#c9c9ee',
          neutral: '#1f2937',
          'base-100': '#0a111f',
          info: '#e76f51',
          success: '#10b981',
          warning: '#86198f',
          error: '#e63946',
        },
        light: {
          primary: '#7c3aed',
          secondary: '#D926A9',
          accent: '#1FB2A6',
          neutral: '#191D24',
          'base-100': '#f3f4f6',
          'base-50': '#f5f5f6',
          info: '#3ABFF8',
          success: '#36D399',
          warning: '#FBBD23',
          error: '#F87272',
        },
      },
    ],
  },
  plugins: [
    require('daisyui'),
    require('@tailwindcss/line-clamp'),
    // ...
  ],
}
