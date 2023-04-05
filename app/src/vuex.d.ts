import { Store } from 'vuex'
import { Room } from '@/types'

declare module '@vue/runtime-core' {
    // declare your own store states
    interface State {
        token: string,
        room: Room
    }

    // provide typings for `this.$store`
    interface ComponentCustomProperties {
        $store: Store<State>
    }
}