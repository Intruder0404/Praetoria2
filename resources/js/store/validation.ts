// Utilities
import {defineStore} from 'pinia'

export const validationStore = defineStore('validation', {
    state: () => ({
        rules: {
            required: value => !!value || 'Required.',
            min8: value => {
                const pattern = /^.{8,}$/
                return pattern.test(value) || 'minimum 8 characters'
            },
            lowerCase1: value => {
                const pattern = /^(.*[a-z].*)$/;
                return pattern.test(value) || 'at least 1 lower character'
            },
            upperCase1: value => {
                const pattern = /^(.*[A-Z].*)$/
                return pattern.test(value) || 'at least 1 upper character'
            },
            digitCase1: value => {
                const pattern = /^(.*\d.*)$/
                return pattern.test(value) || 'at least 1 digit'
            },
            specialCharacter1: value => {
                const pattern = /^(.*\W.*)$/
                return pattern.test(value) || 'at least 1 special character'
            },
            email: value => {
                const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
                return pattern.test(value) || 'Invalid e-mail.'
            }
        }
    }),
})
