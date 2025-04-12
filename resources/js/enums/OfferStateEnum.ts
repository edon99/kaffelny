
export function stateLabel(state: number): string {
    switch (state) {
        case 1:
            return 'Pending';
        case 2:
            return 'Seen';
        case 3:
            return 'Accepted';
        case 4:
            return 'Canceled';
        default:
            return 'Unknown';
    }
}

export function stateColor(state: number): string {
    switch (state) {
        case 1:
            return 'bg-blue-500 p-1 rounded-lg';
        case 2:
            return 'bg-green-200 p-1 rounded-lg';
        case 3:
            return 'bg-green-600 p-1 rounded-lg';
        case 4:
            return 'bg-red-400 p-1 rounded-lg';
        default:
            return 'bg-gray-500 p-1 rounded-lg';
    }}
