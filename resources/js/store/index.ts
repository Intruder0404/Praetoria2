// Utilities
import { createPinia } from 'pinia'
import piniaPluginPersistedstate from 'pinia-plugin-persistedstate'
export { authStore } from './auth';
export { userStore } from './user';
export { characterStore } from './character';
export { religionStore } from './religion';
export { familyStore } from './family';
export { guildStore } from './guild';
export { kingdomStore } from './kingdom';
export { optionsStore } from './options';
export { validationStore } from './validation';

export default createPinia().use(piniaPluginPersistedstate);
