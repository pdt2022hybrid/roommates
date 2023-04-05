export class Task {
    title: string;
    author: string;
    date: Date;
    priority: Priority;
    room?: roomType;

    constructor(title: string, author: string, date: Date, priority?: Priority, room?: roomType) {
        this.title = title;
        this.author = author;
        this.date = date;
        this.priority = priority || Priority.LOW;
        this.room = room;
    }
}

export class Priority {
    static readonly LOW = new Priority("DECENT", "#2FDF75");
    static readonly MEDIUM = new Priority("IMPORTANT", "#FF8A1F");
    static readonly HIGH = new Priority("VERY IMPORTANT", "#FF4961");
    private constructor(public readonly text: string, public readonly color: string) {}
    toString() { return this.text; }
}

export class PresetRoom {
    id: roomType;
    name: string;
    icon?: string;
    constructor(id: roomType, name: string, icon?: string) {
        this.id = id;
        this.name = name;
        this.icon = icon;
    }
}

export const presetRooms = [
    new PresetRoom('kitchen', "Kitchen", 'room_kitchen.svg'),
    new PresetRoom('living', "Living room", 'room_living.svg'),
    new PresetRoom('bath', "Bathroom", 'room_bathroom.svg'),
    new PresetRoom('work', "Work room", 'room_work.svg'),
    new PresetRoom('dining', "Dining room", 'room_dining.svg')
];

export function createCustomRoom(name: string): PresetRoom {
    return new PresetRoom('custom', name, 'room_custom.svg')
}

export const presetRoomsWithCustom:PresetRoom[] = presetRooms.concat(new PresetRoom('custom', "Custom room", 'room_custom.svg'));

export type roomType = 'kitchen' | 'living' | 'bath' | 'work' | 'dining' | 'custom';

export function getPresetRoom(id: roomType) {
    return presetRoomsWithCustom.find(room => room.id === id);
}