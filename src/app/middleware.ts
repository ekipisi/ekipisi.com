import Negotiator from 'negotiator';

import { match } from '@formatjs/intl-localematcher';

const headers = { 'accept-language': 'tr-TR,tr;q=0.5' }
const languages = new Negotiator({ headers }).languages()
const locales = ['en-US', 'tr-TR']
const defaultLocale = 'tr-TR'
 
match(languages, locales, defaultLocale) // -> 'en-US'