
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
        case 5:
            return 'Finished';
        default:
            return 'Unknown';
    }
}

export function stateColor(state: number): string {
    switch (state) {
        case 1:
            return 'bg-blue-500 p-1 rounded-lg';
        case 2:
            return 'bg-yellow-600 p-1 rounded-lg';
        case 3:
            return 'bg-green-500 p-1 rounded-lg';
        case 4:
            return 'bg-red-600 p-1 rounded-lg';
            case 5:
            return 'bg-green-800 p-1 rounded-lg';
        default:
            return 'bg-gray-500 p-1 rounded-lg';
    }}
